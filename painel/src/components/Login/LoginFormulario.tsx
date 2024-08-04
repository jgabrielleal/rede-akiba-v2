import { useForm } from "react-hook-form";

import { useLogin } from "@services/login/mutations"

type Formulario = {
    login: string,
    senha: string,
};

export default function Formulario(){
    const { register, handleSubmit } = useForm<Formulario>();
    const { mutate: Login } = useLogin();
    
    function onSubmit(data: Formulario) {
        Login(data);
    }

    return(
        <form onSubmit={handleSubmit(onSubmit)}>
            <input 
                {...register('login')}
                type="text" 
                id="login" 
                name="login" 
                className="w-full h-16 rounded-t-lg outline-0 border-b border-gray-200 p-4 font-averta font-light" 
                placeholder="Login"
                aria-label="Campo login"
            />
            <input 
                {...register('senha')}
                type="password"
                id="senha"
                name="senha"
                className="w-full h-16 rounded-b-lg outline-0 p-4 font-averta font-light"
                placeholder="Senha"
                aria-label="Campo senha"
            />
            <button className="w-full h-16 bg-azul-medio mt-4 rounded-lg text-aurora font-averta font-light" aria-label="Fazer login no sistema">
                Entrar
            </button>
        </form>
    )
}