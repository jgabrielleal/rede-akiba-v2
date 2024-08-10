import { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useLogado } from '@services/login/queries';
import Loading from '@/components/partials/Loading/Loading';

interface MiddlewareRouteProps {
    view: React.ComponentType<any>;
}

export default function MiddlewareRoute({ view: View }: MiddlewareRouteProps) {
    const { data: logado, isLoading } = useLogado(localStorage.getItem('aki-token') || '');
    const navigate = useNavigate();

    useEffect(() => {
        if (!isLoading && !logado) {
            navigate('/');
        }
    }, [logado, isLoading]);

    if (logado) {
        return <View />;
    }
}