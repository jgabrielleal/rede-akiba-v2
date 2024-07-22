interface RodapeProps{
    tipo: string;
}

export default function Rodape({tipo}: RodapeProps){
    function anoAtual(){
        return new Date().getFullYear();
    }

    function Login(){
        return(
           <div className="mt-4 text-center text-aurora text-md font-averta font-light leading-6">
                &copy; 2016 - {anoAtual()} <br/>
                Rede Akiba - O Paraíso dos Otakus 
           </div> 
        )
    }

    return(
        <>
            {tipo === "login" && (
               <Login/>
            )}
        </>
    )
}