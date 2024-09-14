import { Link } from 'react-router-dom';
import { FaPen, FaEye } from "react-icons/fa";
import {usePagination} from '@/hooks/usePagination';
import { useLogado } from '@/services/login/queries';
import { useMaterias } from '@/services/materias/queries';
import UltimasTarefasPlaceholder from '@/components/skeletons/Dashboard/UltimasMaterias/UltimasMateriasPlaceholder';
import UltimasMateriasFallback from '@/components/skeletons/Dashboard/UltimasMaterias/UltimasMateriasFallback';

export interface materias {
    publicado?: boolean,
    autor?: {
        apelido?: string
    },
    slug?: string,
    titulo?: string,
}

export default function UltimasMaterias() {
    const { data: logado } = useLogado(localStorage.getItem('aki-token') || '');
    const { data: materias, isLoading } = useMaterias()

    if(isLoading){
        return <UltimasTarefasPlaceholder/>
    }

    if(!materias?.pages){
        return <UltimasMateriasFallback/>
    }
    
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Minhas Matérias</h6>
            </div>
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 mt-3">
                {(usePagination({data: materias}) as materias[])?.map((materia: materias, index: number) => (
                    <div key={index} className="bg-azul-claro p-2 rounded-md">
                        <p className="h-[7.5rem] mb-3 line-clamp-6 font-averta uppercase text-aurora leading-5">
                            {materia.titulo}
                        </p>
                        <div className="flex justify-between">
                            <span className="text-aurora font-averta font-bold italic uppercase">
                                {materia.autor?.apelido}
                            </span>
                            <div className="flex gap-2 items-center">
                                <Link to="/painel/materias/1" className="text-aurora" title="Visualizar matéria" aria-label="Visualizar matéria">
                                    <FaEye className="text-lg" />
                                </Link>
                                {logado.apelido === materia.autor?.apelido && (
                                    <Link to="/painel/materias/1" className="text-aurora" title="Editar matéria" aria-label="Editar matéria">
                                        <FaPen />
                                    </Link>
                                )}
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    )
}