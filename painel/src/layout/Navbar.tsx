import { Link } from 'react-router-dom'
import icone from '/images/icone.jpg'
import { HiOutlineMenu } from "react-icons/hi";

export default function Navbar(){
    return (
        <nav className="bg-aurora h-15">
            <div className="w-10/12 lg:w-[80rem] h-15 mx-auto">
                <div className="flex justify-between h-14">
                    <img src={icone} className="w-8 py-[0.78rem]" alt="icone da logomarca"/>
                    <button className="float-right text-azul-claro" aria-label="Abrir menu de navegação">
                        <HiOutlineMenu/>
                    </button>
                </div>
                <ul className="bg-aurora fixed top-0 right-0 w-44 h-screen">
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="ir para o Dashboard">
                            Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="ir para matérias">
                            Matérias
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="ir para locução">
                            Locução
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="Ir para Rádio">
                            Rádio
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="Ir para Podcasts">
                            Podcasts
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="Ir para Marketing">
                            Marketing
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="Ir para ADM's">
                            ADM's
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="Ir para Log's">
                            Log's
                        </Link>
                    </li>
                    <li>
                        <Link to="#" className="font-averta font-bold uppercase italic" aria-label="Ir para Perfil">
                            Perfil
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>
    )
}