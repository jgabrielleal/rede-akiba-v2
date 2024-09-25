import { useEffect } from "react";
import { useQueryClient } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { usePageName } from "@/hooks/usePageName";
import { useReview } from '@/services/reviews/queries';
import SwitchDePublicacoes from "@/components/partials/Publicacoes/SwitchDePublicacoes";
import ImagemEmDestaque from "@/components/partials/Publicacoes/Reviews/ImagemEmDestaque";
import Titulo from "@/components/partials/Publicacoes/Reviews/Titulo";
import CapaDoReview from "@/components/partials/Publicacoes/Reviews/CapaDoReview";
import EscrevaSeuReview from "@/components/partials/Publicacoes/Reviews/EscrevaSeuReview";
import SubmitDeReview from "@/components/partials/Publicacoes/Reviews/SubmitDeReview";
import TodosOsReviews from "@/components/partials/Publicacoes/Reviews/TodosOsReviews";

export default function Reviews() {
    const { slug } = useParams();
    const queryClient = useQueryClient();
    const { data: review } = useReview(slug ?? "");
    usePageName(review?.titulo || "Novo review");

    useEffect(() => {
        queryClient.invalidateQueries({queryKey: ['Reviews']});
        queryClient.invalidateQueries({queryKey: ['ReviewsInfinite']});
    }, [slug]);	

    return (
        <>
            <SwitchDePublicacoes />
            <div className="container mx-auto mt-8 grid grid-cols-1 xl:grid-cols-4 gap-4 w-10/12 xl:w-[75rem]">
                <div className="col-span-1 xl:col-span-1">
                    <ImagemEmDestaque />
                </div>
                <div className="col-span-1 xl:col-span-3">
                    <Titulo />
                    <CapaDoReview />
                    <EscrevaSeuReview />
                </div>
                <SubmitDeReview />
            </div>
            <TodosOsReviews/>
        </>
    );
}