import { Link } from 'react-router-dom';
import classNames from 'classnames';
import { FaPen } from "react-icons/fa";
import { usePagination } from '@/hooks/usePagination';
import { useLogado } from '@/services/login/queries';
import { useMaterias } from '@/services/materias/queries';

import TodasAsPublicacoesPlaceholder from '@/components/skeletons/Publicacoes/TodasAsPublicacoes/TodasAsPublicacoesPlaceholder';
import TodasAsPublicacoesFallback from '@/components/skeletons/Publicacoes/TodasAsPublicacoes/TodasAsPublicacoesFallback';

export interface Materias {
    autor?: {
        apelido?: string
    },
    slug?: string,
    titulo?: string,
    status?: string, // Added status property
}

export default function TodasAsMaterias() {
    const { data: logado } = useLogado(localStorage.getItem('aki-token') || '');
    const { data: materias, isLoading, fetchNextPage, hasNextPage, isFetchingNextPage } = useMaterias();

    if (isLoading) {
        return <TodasAsPublicacoesPlaceholder type="materias" />
    }

    if (materias?.pages && materias.pages[0] === "") {
        return <TodasAsPublicacoesFallback type="materias" />
    }

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default" id="materias-title-default">
                <h6>Todas as matérias</h6>
            </div>
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 mt-3">
                {(usePagination({ data: materias }) as Materias[])?.map((materia: Materias, index: number) => (
                    <div key={index} className={classNames('p-2 rounded-md', {
                        'bg-azul-claro': materia?.status === 'publicado',
                        'bg-verde': materia?.status === 'rascunho',
                        'bg-laranja-claro': materia?.status === 'revisao',
                    })}>
                        <p className="h-[7.5rem] mb-3 line-clamp-6 font-averta uppercase text-aurora leading-5">
                            {materia.titulo}
                        </p>
                        <div className="flex justify-between">
                            <span className="text-aurora font-averta font-bold italic uppercase">
                                {materia.autor?.apelido}
                            </span>
                            {logado?.niveis_de_acesso?.includes('administrador') && (
                                <Link 
                                    to={`/materias/${materia.slug}`} 
                                    onClick={()=>{ window.scrollTo({ top: 0, behavior: 'smooth' });}}
                                    className="text-aurora mr-1 mt-1" 
                                    title="Editar matéria" 
                                    aria-label="Editar matéria"
                                >
                                    <FaPen />
                                </Link>
                            )}
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