import { useState, useEffect } from "react";
import { useQueryClient } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { useForm } from "react-hook-form";
import { toast } from "react-toastify";
import { useError } from "@/hooks/useError";
import { usePageName } from "@/hooks/usePageName";
import { useLogado } from "@/services/login/queries";
import { useReview } from '@/services/reviews/queries';
import { useCreateReview } from "@/services/reviews/mutations";
import { useUpdateReview } from "@/services/reviews/mutations";

import SwitchDePublicacoes from "@/components/partials/Publicacoes/SwitchDePublicacoes";
import ImagemEmDestaque from "@/components/partials/Publicacoes/Reviews/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Reviews/Titulo";
import CapaDoReview from "@/components/partials/Publicacoes/Reviews/CapaDoReview";
import EscrevaSeuReview from "@/components/partials/Publicacoes/Reviews/EscrevaSeuReview";
import SubmitDeReview from "@/components/partials/Publicacoes/Reviews/SubmitDeReview";
import TodosOsReviews from "@/components/partials/Publicacoes/Reviews/TodosOsReviews";
import SinopseDoAnime from "@/components/partials/Publicacoes/Reviews/SinopseDoAnime";

export default function Reviews() {
    const [isReviewSelecionado, setIsReviewSelecionado] = useState<number | null>(null);
    const [isRefresh, setIsRefresh] = useState<boolean>(false);

    const { handleSubmit, register, setValue, reset } = useForm();

    const { slug } = useParams();

    const queryClient = useQueryClient();
    const { data: logado } = useLogado(localStorage.getItem('aki-token') || '');
    const { data: review } = useReview(slug ?? "");
    const { mutate: createReview } = useCreateReview(() => {
        toast.success('"Sugoi! O seu review foi atualizado! ٩(＾◡＾)۶"');
        setIsRefresh(prev => !prev);
        reset();
    });
    const { mutate: updateReview } = useUpdateReview(slug ?? "", () => {
        toast.success("Sugoi! O review foi atualizado! ٩(＾◡＾)۶");
        setIsRefresh(prev => !prev);
    });

    const { data: onError } = useError();
    const { data: pageName } = usePageName();

    pageName(review?.titulo || "Novo review");

    useEffect(() => {
        queryClient.invalidateQueries({ queryKey: ['Reviews'] });
        queryClient.invalidateQueries({ queryKey: ['ReviewsInfinite'] });
    }, [slug]);

    function onSubmit(data: any) {
        let conteudo = review?.conteudo;

        if (conteudo) {
            const index = conteudo.findIndex((result: any) => result.id === isReviewSelecionado);
            const autor = conteudo[index].autor;
            conteudo[index] = {
                id: isReviewSelecionado,
                autor: autor,
                conteudo: data.conteudo,
            }
        } else {
            conteudo = [{
                id: logado.id,
                autor: logado.apelido,
                conteudo: data.conteudo,
            }]
        }

        const newData = {
            autor: logado.id,
            imagem_em_destaque: data.imagem_em_destaque,
            capa_da_review: data.capa_da_review,
            titulo: data.titulo,
            sinopse: data.sinopse,
            conteudo: conteudo,
            reacoes: data.reacoes
        }

        if (slug) {
            updateReview(newData);
        } else {
            createReview(newData);
            reset()
        }
    }

    return (
        <>
            <SwitchDePublicacoes />
            <form onSubmit={handleSubmit(onSubmit, onError)} key={isRefresh ? 'refresh-true' : 'refresh-false'}>
                <div className="container mx-auto mt-8 grid grid-cols-1 xl:grid-cols-4 gap-4 w-10/12 xl:w-[75rem]">
                    <div className="col-span-1 xl:col-span-1">
                        <ImagemEmDestaque register={register} setValue={setValue} />
                    </div>
                    <div className="col-span-1 xl:col-span-3">
                        <Titulo register={register} setValue={setValue} />
                        <SinopseDoAnime register={register} setValue={setValue} />
                        <CapaDoReview register={register} setValue={setValue} />
                        <EscrevaSeuReview register={register} setValue={setValue} isReviewSelecionado={isReviewSelecionado} setIsReviewSelecionado={setIsReviewSelecionado} />
                    </div>
                    <SubmitDeReview />
                </div>
            </form>
            <TodosOsReviews />
        </>
    );
}