import { MdOutlineKeyboardDoubleArrowRight } from "react-icons/md";
import { useLogado } from '@services/login/queries';

export default function AvisosParaEquipeFallback() {
    const { data: logado } = useLogado(localStorage.getItem('token') || '');

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Avisos para equipe</h6>
            </div>
            <div className="flex justify-center lg:justify-start gap-3 flex-wrap mt-3">
                <div className="w-full lg:w-[18.18rem] h-40 bg-azul-fallback rounded-md p-3">
                    <h6 className="font-averta font-bold text-aurora text-xl uppercase flex items-center gap-1">
                        Aki-chan<MdOutlineKeyboardDoubleArrowRight className="mt-1" />{logado?.data.apelido}
                    </h6>
                    <p className="font-averta text-aurora text-xs line-clamp-6 mt-1">
                        Kanashimi {logado?.data.apelido} (◞ ‸ ◟ㆀ). Parece que você não é muito lembrado né?
                        Mas não se preocupe, quando precisarem de você serei a primeira a te avisar!
                        （＾ｖ＾）
                    </p>
                </div>
            </div>
        </section>
    )
}