import { FaPen } from "react-icons/fa";
import { usePagination } from '@/hooks/usePagination';
import { useReviews } from '@/services/reviews/queries';

import TodosOsReviewsPlaceholder from '@/components/skeletons/Publicacoes/TodosOsReviews/TodosOsReviewsPlaceholder';
import TodosOsReviewsFallback from '@/components/skeletons/Publicacoes/TodosOsReviews/TodosOsReviewsFallback';

export interface Reviews {
    autor?: {
        apelido?: string
    },
    slug?: string,
    titulo?: string,
}

export default function TodosOsReviews() {
    const { data: reviews, isLoading, fetchNextPage, hasNextPage, isFetchingNextPage } = useReviews();

    if (isLoading) {
        return <TodosOsReviewsPlaceholder />
    }

    if (reviews?.pages && reviews.pages[0] === "") {
        return <TodosOsReviewsFallback />;
    }

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default" id="reviews-title-default">
                <h6>Todas os reviews</h6>
            </div>
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 mt-3">
                {(usePagination({ data: reviews }) as Reviews[])?.map((review: Reviews, index: number) => (
                    <div key={index} className='p-2 rounded-md bg-azul-claro'>
                        <p className="h-[7.5rem] mb-3 line-clamp-6 font-averta uppercase text-aurora leading-5">
                            {review?.titulo}
                        </p>
                        <div className="flex justify-between">
                            <span className="text-aurora font-averta font-bold italic uppercase">
                                {review?.autor?.apelido}
                            </span>
                            <a href={`/reviews/${review?.slug}`} className="text-aurora mr-1 mt-1" title="Editar review" aria-label="Editar matéria">
                                <FaPen />
                            </a>
                        </div>
                    </div>
                ))}
            </div>
            {hasNextPage && (
                <div className="flex justify-center mt-8">
                    <button
                        className="px-4 py-1 border-4 border-azul-claro rounded-xl font-averta font-bold text-aurora text-xl text-azul-claro uppercase"
                        onClick={() => fetchNextPage()}
                        disabled={!hasNextPage || isFetchingNextPage}
                    >
                        {isFetchingNextPage ? 'Carregando...' : hasNextPage ? 'Carregar mais matérias' : null}
                    </button>
                </div>
            )}
        </section>
    )
}