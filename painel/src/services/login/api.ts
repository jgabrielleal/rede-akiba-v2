import axios from 'axios';

export async function Login(data:any){
    console.log(data)
    try {
        const response = await axios.post(`${import.meta.env.VITE_API}/autenticacao/login`, {
            login: data.login,
            senha: data.senha
        }, {
            headers: {
                'Content-Type': 'application/json'
            }
        });
        return response;
    } catch (error: any) {
        console.log(error);
    }
}

export async function Logado(token: string){
    try{
        const response = await axios.post(`${import.meta.env.VITE_API}/autenticacao/logado`, {
            token: token,
        }, {
            headers: {
                'Content-Type': 'application/json'
            }
        });
        return response;
    }catch(error: any){
        throw error;
    }
}

export function Deslogar(token: string){
    try{
        const response = axios.post(`${import.meta.env.VITE_API}/autenticacao/deslogar`,{
            token: token,
        }, {
            headers: {
                'Content-Type': 'application/json'
            }
        });
        return response;
    }catch(error: any){
        throw error;
    }
}