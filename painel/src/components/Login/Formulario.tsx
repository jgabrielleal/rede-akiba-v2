export default function Formulario(){
    return(
        <form>
            <input 
                type="text" 
                id="login" 
                name="login" 
                className="w-full h-16 rounded-t-lg outline-0 border-b border-gray-200 p-4 font-averta font-light" 
                placeholder="Login"
                aria-label="login"
            />
            <input 
                type="password"
                id="senha"
                name="senha"
                className="w-full h-16 rounded-b-lg outline-0 p-4 font-averta font-light"
                placeholder="Senha"
                aria-label="senha"
            />
            <button className="w-full h-16 bg-azul-medio mt-4 rounded-lg text-aurora font-averta font-light">
                Entrar
            </button>
        </form>
    )
}