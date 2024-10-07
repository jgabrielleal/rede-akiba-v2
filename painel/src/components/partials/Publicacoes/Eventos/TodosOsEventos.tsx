import { Link } from 'react-router-dom';
import { FaPen } from "react-icons/fa";
import classNames from 'classnames';
import { usePagination } from '@/hooks/usePagination';
import { useEventos } from '@/services/eventos/queries';

import TodasAsPublicacoesPlaceholder from '@/components/skeletons/Publicacoes/TodasAsPublicacoes/TodasAsPublicacoesPlaceholder';
import TodasAsPublicacoesFallback from '@/components/skeletons/Publicacoes/TodasAsPublicacoes/TodasAsPublicacoesFallback';

export interface Eventos {
    autor?: {
        apelido?: string
    },
    slug?: string,
    status?: string,
    titulo?: string,
}

export default function TodosOsEventos() {
    const { data: eventos, isLoading, fetchNextPage, hasNextPage, isFetchingNextPage } = useEventos();

    if (isLoading) {
        return <TodasAsPublicacoesPlaceholder type="eventos" />
    }

    if (eventos?.pages && eventos.pages[0] === "") {
        return <TodasAsPublicacoesFallback type="eventos" />;
    }

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default" id="eventos-title-default">
                <h6>Todos os eventos</h6>
            </div>
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 mt-3">
                {(usePagination({ data: eventos }) as Eventos[])?.map((evento: Eventos, index: number) => (
                    <div key={index} className={classNames('p-2 rounded-md', {
                        'bg-verde': evento?.status === 'rascunho',
                    })}>                        
                    <p className="h-[7.5rem] mb-3 line-clamp-6 font-averta uppercase text-aurora leading-5">
                            {evento?.titulo}
                        </p>
                        <div className="flex justify-between">
                            <span className="text-aurora font-averta font-bold italic uppercase">
                                {evento?.autor?.apelido}
                            </span>
                            <Link 
                                to={`/eventos/${evento?.slug}`} 
                                onClick={()=>{ window.scrollTo({ top: 0, behavior: 'smooth' });}}
                                className="text-aurora mr-1 mt-1" 
                                title="Editar evento" 
                                aria-label="Editar matéria"
                            >
                                <FaPen />
                            </Link>
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