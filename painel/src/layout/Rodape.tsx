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
            <div className="bg-azul-medio py-5">
                <img src={logomarca} alt="Logomarca da Rede Akiba" className="w-32 mx-auto" />
                <div className="mt-4 text-center text-aurora text-md font-averta font-light leading-6">
                    &copy; 2016 - {anoAtual()} | Rede Akiba - O Paraíso dos Otakus <br />
                    AKI Painel - Painel de Controle da Rede Akiba | Versão 1.0.0
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