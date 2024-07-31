import { Link } from 'react-router-dom'
import icone from '/images/icone.jpg'
import { HiOutlineMenu } from "react-icons/hi";

export default function Navbar(){
    return (
        <nav className="bg-aurora h-15">
            <div className="w-10/12 lg:w-[80rem] h-15 mx-auto">
                <div className="flex justify-between h-14">
                    <img src={icone} className="w-8 py-[0.78rem]" alt="icone da logomarca"/>
                    <button className="float-right text-azul-claro">
                        <HiOutlineMenu/>
                    </button>
                </div>
                <ul className="bg-aurora fixed top-0 right-0 w-44 h-screen">
                    <li>
                        <Link to="#">
                            Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            Matérias
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            Locução
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            Rádio
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            Podcasts
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            Marketing
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            ADM's
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            Logs
                        </Link>
                    </li>
                    <li>
                        <Link to="#">
                            Perfil
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>
    )
}