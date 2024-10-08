import { useLogado } from '@services/login/queries';
import BoasVindasPlaceholder from '@/components/skeletons/Dashboard/BoasVindas/BoasVindasPlaceholder';
import BoasVindasFallback from '@/components/skeletons/Dashboard/BoasVindas/BoasVindasFallback';

export default function BoasVindas(){
    const { data: logado, isLoading, isError } = useLogado(localStorage.getItem('token') || '');

    if(isLoading){
        return <BoasVindasPlaceholder />
    }

    if(isError){
        return <BoasVindasFallback />
    }

    return(
        <section className="flex justify-center">
            <div className="w-10/12 md:w-[45rem] mt-10 border-4 border-azul-claro py-2 px-4 rounded-xl text-laranja-claro text-center text-2xl uppercase italic font-averta font-bold">
                Olá {logado?.apelido}, o que tem pra hoje?
            </div>
        </section>
    )
}