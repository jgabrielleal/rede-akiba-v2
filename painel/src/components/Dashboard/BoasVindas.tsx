import { useLogado } from '@services/login/queries';

import BoasVindasPlaceholder from '@/placeholders/Dashboard/BoasVindasPlaceholder';
import BoasVindasFallback from '@/placeholders/Dashboard/BoasVindasFallback';

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
            <div className="w-10/12 xl:w-[45rem] mt-10 border-4 border-azul-claro py-2 px-4 rounded-xl text-laranja text-center text-2xl uppercase italic font-averta font-bold">
                Olá {logado?.apelido}, o que tem pra hoje?
            </div>
        </section>
    )
}