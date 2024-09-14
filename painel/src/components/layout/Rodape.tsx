import logomarca from "/images/logo.png";

interface RodapeProps {
    tipo: string;
}

export default function Rodape({ tipo }: RodapeProps) {
    function anoAtual() {
        return new Date().getFullYear();
    }

    function Login() {
        return (
            <div className="mt-4 text-center text-aurora text-md font-averta font-light leading-6">
                &copy; 2016 - {anoAtual()} <br />
                Rede Akiba - O Paraíso dos Otakus
            </div>
        )
    }

    function Interno() {
        return (
            <div className="bg-[#000823] pt-8 pb-7">
                <div className="w-10/12 xl:w-[75rem] mx-auto">
                    <img src={logomarca} alt="Logomarca da Rede Akiba" className="w-36" />
                    <div className="mt-5 text-aurora text-md font-averta font-light leading-6">
                        &copy; 2016 - {anoAtual()} | Rede Akiba - O Paraíso dos Otakus <br />
                        AKI Painel - Painel de Controle da Rede Akiba | Versão 1.0.0
                    </div>
                </div>
            </div>
        )
    }

    return (
        <>
            {tipo === "login" && (
                <Login />
            )}
            {tipo === "interno" && (
                <Interno />
            )}
        </>
    )
}