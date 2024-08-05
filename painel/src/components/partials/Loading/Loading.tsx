import loading from "/images/loading.gif";

export default function Loading(){
    return(
        <div className="w-screen h-screen fixed top-0 z-50 flex justify-center items-center bg-azul-escuro">
            <img src={loading} alt="Carregando..." className="w-32"/>
        </div>
    )
}