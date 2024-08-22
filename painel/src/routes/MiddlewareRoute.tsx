import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

interface MiddlewareRouteProps {
    view: React.ComponentType<any>;
}

export default function MiddlewareRoute({ view: View }: MiddlewareRouteProps) {
    const [isAuthenticated, setIsAuthenticated] = useState<boolean | null>(null);
    const navigate = useNavigate();

    useEffect(() => {
        async function requisicao() {
            try {
                const response = await axios.post(`${import.meta.env.VITE_API}/autenticacao/logado`, {
                    token: localStorage.getItem('aki-token')
                });
                setIsAuthenticated(response.data);
            } catch (error) {
                console.error('Erro na requisição:', error);
                setIsAuthenticated(false);
            }
        }

        requisicao(); // Verificação inicial
        const intervalId = setInterval(requisicao, 10 * 60000); 
        return () => clearInterval(intervalId); 
    }, []);

    useEffect(() => {
        if (isAuthenticated === false) {
            navigate('/');
        }
    }, [isAuthenticated, navigate]);

    return <View />;
}