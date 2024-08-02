import { Link } from 'react-router-dom'
import { HiOutlineMenu } from "react-icons/hi";
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

export default function Navbar(){
    return (
        <nav className="bg-aurora h-15">
            <div className="w-10/12 xl:w-[80rem] h-15 mx-auto">
                <div className="flex justify-between h-14">
                    <img src={icone} className="w-8 py-[0.78rem]" alt="icone da logomarca"/>
                    <button className="float-right text-azul-claro xl:hidden" aria-label="Abrir menu de navegação">
                        <HiOutlineMenu/>
                    </button>
                </div>
                <ul className="bg-aurora xl:bg-transparent fixed xl:block top-0 right-0 w-44 xl:w-full h-screen xl:h-14 p-4 xl:flex xl:gap-4 xl:justify-center">
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="ir para o dashboard">
                            <img src={dashboard} alt="Icone dashboard"/>Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="ir para matérias">
                            <img src={materias} alt="Icone matérias"/>Matérias
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="ir para locução">
                            <img src={locucao} alt="Icone locução"/>Locução
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="Ir para rádio">
                            <img src={radio} alt="Icone rádio"/>Rádio
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="Ir para podcasts">
                            <img src={podcasts} alt="Icone podcasts"/>Podcasts
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="Ir para marketing">
                            <img src={marketing} alt="Icone marketing"/>Marketing
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="Ir para ADM's">
                            <img src={adms} alt="Icone ADM's"/>ADM's
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="Ir para Log's">
                            <img src={logs} alt="Icone log's"/>Log's
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="nav-hover font-averta font-bold uppercase italic flex gap-1 mb-3" aria-label="Ir para Perfil">
                            <img src={perfil} alt="Icone perfil"/>Perfil
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>
    )
}