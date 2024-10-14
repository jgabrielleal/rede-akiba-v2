import { useState } from 'react';
import classNames from 'classnames';
import { useLogado } from '@services/login/queries';
import { useProgramas } from '@/services/programas/queries';

import { Offcanvas } from '@/components/layout/Offcanvas';
import NovoPrograma from "@/components/partials/Locucao/NovoPrograma"

interface Programas {
    id: number,
    logo_do_programa: string,
    locutor: {
        id: number
    }
}

export default function Programas() {
    const { data: logado } = useLogado(localStorage.getItem('token') || '');
    const { data: programas } = useProgramas();

    const [isProgramaSelecionado, setIsProgramaSelecionado] = useState<number | undefined>();

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto pt-8">
            <div className="title-default">
                <h6>Meus Programas</h6>
            </div>
            <div className="gap-10 xl:gap-0 flex flex-wrap justify-center items-center my-3">
                {Array.isArray(programas) && programas.filter((programa: Programas) => programa.locutor.id === logado?.id).map((programa: Programas, index: number) => (
                    <div key={index} className={classNames('xl:pl-10 xl:pr-10', {
                        'xl:border-r': logado.niveis_de_acesso.includes('administrador')
                    })}>
                        <img 
                            onClick={() => setIsProgramaSelecionado(prev => prev === programa.id ? undefined : programa.id)} 
                            className={classNames('cursor-pointer w-52 transition-transform', { 
                                'opacity-45 scale-95': isProgramaSelecionado === programa.id,
                            })}
                            src={programa.logo_do_programa} 
                            alt="logo do programa" 
                        />
                    </div>
                ))}
                {logado?.niveis_de_acesso.includes('administrador') && (
                    <div className="flex items-center xl:ml-10">
                        <Offcanvas button="Cadastrar" title="Cadastrar programa" className="px-16 py-1 border-4 border-azul-claro rounded-xl font-averta font-bold text-aurora text-xl text-azul-claro uppercase">
                            <NovoPrograma />
                        </Offcanvas>
                    </div>
                )}
            </div>
        </section>
    )
}