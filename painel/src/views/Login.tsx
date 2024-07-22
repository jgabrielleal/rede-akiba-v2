import logomarca from "/images/logo.png";
import Formulario from "@components/Login/Formulario";
import Rodape from "@layouts/Rodape";

export default function Login(){
    return(
        <div className="w-screen h-screen bg-login bg-repeat bg-cover bg-center flex justify-center items-center animate-fade-in">
            <section className="w-56">
                <div className="w-full flex justify-center">
                    <img  
                        className="w-36"
                        src={logomarca} 
                        alt="logomarca"
                        title="logomarca da Rede Akiba"
                        loading="lazy"
                    />
                </div>
                <strong className="block w-full text-center mt-4 mb-2 font-averta font-light text-aurora">Realize o login para acessar:</strong>
                <Formulario />
                <Rodape tipo="login"/>
            </section>
        </div>
    )
}