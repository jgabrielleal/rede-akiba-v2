import { api } from '@services/axios.default'

export async function Login(data:any){
    try {
        const response = await api.post(`${import.meta.env.VITE_API}/autenticacao/login`, {
            login: data.login,
            senha: data.senha
        });
        return response;
    } catch (error: any) {
        console.log(error);
    }
}

export async function Logado(token: string){
    try{
        const response = await api.post(`${import.meta.env.VITE_API}/autenticacao/logado`, {
            token: token,
        });
        return response;
    }catch(error: any){
        throw error;
    }
}

export function Deslogar(token: string){
    try{
        const response = api.post(`${import.meta.env.VITE_API}/autenticacao/deslogar`,{
            token: token,
        });
        return response;
    }catch(error: any){
        throw error;
    }
}