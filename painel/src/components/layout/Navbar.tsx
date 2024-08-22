import { Link } from 'react-router-dom'
import { HiOutlineMenu } from "react-icons/hi";
import { useLogado } from '@services/login/queries'
import { useNavbarToggle } from '@/hooks/useNavbarToggle';
import icone from '/images/icone.jpg'
import dashboard from '/svgs/navbar/DASHBOARD.svg'
import materias from '/svgs/navbar/MATERIAS.svg'
import locucao from '/svgs/navbar/LOCUCAO.svg'
import radio from '/svgs/navbar/RADIO.svg'
import podcasts from '/svgs/navbar/PODCASTS.svg'
import marketing from '/svgs/navbar/MARKETING.svg'
import adms from '/svgs/navbar/ADMS.svg'
import logs from '/svgs/navbar/LOGS.svg'
import perfil from '/svgs/navbar/PERFIL.svg'

export default function Navbar() {
    const { data: logado } = useLogado(localStorage.getItem('aki-token') || '');
    
    const usuarioLogado = logado?.data
    const { navlist, toggle } = useNavbarToggle();
    
    return (
        <nav className="bg-aurora h-15">
            <div className="w-10/12 xl:w-[75rem] h-12 mx-auto">
                <div className="flex justify-between h-12">
                    <img src={icone} className="w-6 h-6 mt-3" alt="Ícone da logomarca" />
                    <button className="float-right text-azul-claro xl:hidden" aria-label="Abrir menu de navegação" onClick={() => { toggle() }}>
                        <HiOutlineMenu />
                    </button>
                </div>
                <ul ref={navlist} className="hidden z-10 bg-aurora xl:bg-transparent fixed xl:static top-0 right-0 xl:-mt-[3.2rem] xl:w-full h-screen xl:h-14 p-4 xl:flex xl:gap-4 xl:justify-center">
                    <li>
                        <Link to="/dashboard" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para o dashboard" aria-label="Ir para o dashboard">
                            <img src={dashboard} alt="Ícone do dashboard" />Dashboard
                        </Link>
                    </li>
                    {(usuarioLogado?.niveis_de_acesso.includes("administrador") || usuarioLogado?.niveis_de_acesso.includes("redator")) && (
                        <li>
                            <Link to="/materias" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para matérias" aria-label="Ir para matérias">
                                <img src={materias} alt="Ícone de matérias" />Matérias
                            </Link>
                        </li>
                    )}
                    {(usuarioLogado?.niveis_de_acesso.includes("administrador") || usuarioLogado?.niveis_de_acesso.includes("locutor")) && (
                        <li>
                            <Link to="/locucao" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para locução" aria-label="Ir para locução">
                                <img src={locucao} alt="Ícone de locução" />Locução
                            </Link>
                        </li>
                    )}
                    {usuarioLogado?.niveis_de_acesso.includes("administrador") && (
                        <>
                            <li>
                                <Link to="/radio" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para rádio" aria-label="Ir para rádio">
                                    <img src={radio} alt="Ícone de rádio" />Rádio
                                </Link>
                            </li>
                            <li>
                                <Link to="/podcasts" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para podcasts" aria-label="Ir para podcasts">
                                    <img src={podcasts} alt="Ícone de podcasts" />Podcasts
                                </Link>
                            </li>
                            <li>
                                <Link to="/marketing" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para marketing" aria-label="Ir para marketing">
                                    <img src={marketing} alt="Ícone de marketing" />Marketing
                                </Link>
                            </li>
                            <li>
                                <Link to="/adms" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para ADM's" aria-label="Ir para ADM's">
                                    <img src={adms} alt="Ícone de ADM's" />ADM's
                                </Link>
                            </li>
                            <li>
                                <Link to="/logs" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para logs" aria-label="Ir para logs">
                                    <img src={logs} alt="Ícone de logs" />Logs
                                </Link>
                            </li>
                        </>
                    )}
                    <li>
                        <Link to="/perfil" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" title="Ir para perfil" aria-label="Ir para perfil">
                            <img src={perfil} alt="Ícone de perfil" />Perfil
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>
    )
}