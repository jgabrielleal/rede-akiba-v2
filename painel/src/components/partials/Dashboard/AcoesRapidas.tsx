import { Link } from "react-router-dom";
import { FaNewspaper, FaBell, FaUpload, FaMicrophoneLines, FaCalendarDays } from "react-icons/fa6";
import { useLogado } from '@services/login/queries'

export default function AcoesRapidas() {
    const { data: logado } = useLogado(localStorage.getItem('token') || '')
    const usuarioLogado = logado?.data

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Ações rápidas</h6>
            </div>
            <div className="flex flex-wrap gap-3 mt-3">
                {(usuarioLogado?.niveis_de_acesso.includes("administrador") || usuarioLogado?.niveis_de_acesso.includes("redator")) && (
                    <Link to="/nova-materia" title="Criar uma nova matéria" aria-label="Criar uma nova matéria" className="py-1 px-3 rounded-md bg-azul-claro flex items-center gap-1 uppercase text-aurora font-averta font-bold">
                        <FaNewspaper />Nova matéria
                    </Link>
                )}
                {(usuarioLogado?.niveis_de_acesso.includes("administrador")) && (
                    <>
                        <Link to="/criar-avisos" title="Criar novos avisos" aria-label="Criar novos avisos" className="py-1 px-3 rounded-md bg-azul-claro flex items-center gap-1 uppercase text-aurora font-averta font-bold">
                            <FaBell />Criar avisos
                        </Link>
                        <Link to="/deixar-arquivos" title="Deixar novos arquivos" aria-label="Deixar novos arquivos" className="py-1 px-3 rounded-md bg-azul-claro flex items-center gap-1 uppercase text-aurora font-averta font-bold">
                            <FaUpload />Deixar arquivos
                        </Link>
                    </>
                )}
                {(usuarioLogado?.niveis_de_acesso.includes("administrador") || usuarioLogado?.niveis_de_acesso.includes("locutor")) && (
                    <Link to="/iniciar-programa" title="Iniciar um novo programa" aria-label="Iniciar um novo programa" className="py-1 px-3 rounded-md bg-azul-claro flex items-center gap-1 uppercase text-aurora font-averta font-bold">
                        <FaMicrophoneLines />Iniciar programa
                    </Link>
                )}
                {(usuarioLogado?.niveis_de_acesso.includes("administrador")) && (
                    <Link to="/adicionar-eventos" title="Adicionar novos eventos" aria-label="Adicionar novos eventos" className="py-1 px-3 rounded-md bg-azul-claro flex items-center gap-1 uppercase text-aurora font-averta font-bold">
                        <FaCalendarDays />Adicionar eventos
                    </Link>
                )}
            </div>
        </section>
    )
}