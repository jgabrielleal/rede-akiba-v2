import { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import classNames from 'classnames';
import { useLogado } from '@/services/login/queries';
import { useReview } from '@/services/reviews/queries';

import EscrevaSuaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/EscrevaSuaPublicacao/EscrevaSuaPublicacaoPlaceholder";

interface Review {
    id: number;
    autor: string;
    conteudo: string;
}

export default function EscrevaSeuReview({ register, setValue, isReviewSelecionado, setIsReviewSelecionado }: any) {
    const { slug } = useParams();
    const { data: logado } = useLogado(localStorage.getItem('aki-token') ?? '');
    const { data: review, isLoading } = useReview(slug ?? "");

    const buscaReviewDoUsuarioLogado = review?.conteudo?.find((result: Review) => result.autor === logado.apelido);    
    const buscaReviewDoUsuarioSelecionado = review?.conteudo?.find((result: Review) => result.id === isReviewSelecionado)

    useEffect(() => {
        if(slug && review) {
            setIsReviewSelecionado(buscaReviewDoUsuarioLogado?.id);
            register("conteudo");   
        }
    }, [slug, review])

    if (isLoading) {
        return <EscrevaSuaPublicacaoPlaceholder />
    }

    const modules = {
        toolbar: [
            [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'align': [] }],
            [{ 'color': [] }, { 'background': [] }],
            ['link', 'image', 'video'],
            ['clean'] // remove formatting button
        ]
    };

    return (
        <section>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Escreva seu review
            </span>
            <div className="flex gap-2 flex-wrap mb-1">
                {review?.conteudo?.map((review: Review, index: number) => (
                    <button type="button" key={index} onClick={() => { setIsReviewSelecionado(review?.id) }} className={classNames('bg-aurora text-laranja-claro font-averta font-bold uppercase px-4 py-1 rounded-md', {
                        'bg-gray-200': isReviewSelecionado === review?.id,
                    })}>
                        {review?.autor}
                    </button>
                ))}
            </div>
            <div className="bg-aurora h-96 rounded-md">
                <ReactQuill
                    theme="snow"
                    modules={modules}
                    value={buscaReviewDoUsuarioSelecionado?.conteudo ?? ""}
                    onChange={(content) => { setValue("conteudo", content) }}
                    placeholder={
                        !isReviewSelecionado ? "Oiieh ٩(＾◡＾)۶! Parece que você nunca me contou sua opinião sobre esse anime, diga algo! O que você achou?" : ""
                    }
                />
            </div>
        </section>
    );
}