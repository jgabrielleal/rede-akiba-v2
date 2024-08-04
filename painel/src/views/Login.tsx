import logomarca from "/images/logo.png";

import PageName from "@utils/PageName";

import LoginFormulario from "@components/Login/LoginFormulario";

import Rodape from "@/layout/Rodape";

export default function Login(){
    PageName("Realize o Login");

    return(
        <div className="w-screen h-screen bg-azul-escuro flex justify-center items-center animate-fade-in">
            <section className="w-56">
                <div className="w-full flex justify-center">
                    <img  
                        className="w-36"
                        src={logomarca} 
                        alt="logomarca"
                        title="Logomarca da Rede Akiba"
                    />
                </div>
                <strong className="block w-full text-center mt-4 mb-2 font-averta font-light text-aurora">
                    Realize o login para acessar:
                </strong>
                <LoginFormulario />
                <Rodape tipo="login"/>
            </section>
        </div>
    )
}