import { useEventosCalendario } from "@/services/calendario/queries"

interface Calendario {
    id: number
    evento: string
    dia: string
    hora: string
    categoria: string
    designado: {
        apelido: string
    }
}

function renderConteudo(calendarioData: Calendario[], dia: string) {
    function color(evento: Calendario) {
        switch (evento.categoria) {
            case 'programas':
                return 'bg-azul-claro'
            case 'lives':
                return 'bg-[#b82bff]'
            case 'youtube':
                return 'bg-[#f43e37]'
            case 'podcast':
                return 'bg-[#00a859]'
            default:
                return 'bg-azul-claro'
        }
    }

    function horas(evento: Calendario) {
        const hora = evento.hora.split(':')
        return `${hora[0]}:${hora[1]}H`
    }

    const eventosOrdenados = calendarioData
    ?.filter(evento => evento.dia === dia)
    .sort((a, b) => a.hora.localeCompare(b.hora));

    return (
        <>
            {eventosOrdenados?.map((evento: Calendario, index: number) => (
                <div key={index} className={`${color(evento)} py-2 px-2 rounded-md mb-3`}>
                    <span className="block text-aurora text-2xl text-center font-averta uppercase">
                        {horas(evento)}
                    </span>
                    <h6 className="my-3 text-aurora text-xl text-center font-averta font-bold leading-6">
                        {evento.evento}
                    </h6>
                    <span className="block text-aurora text-sm text-end font-averta">
                        {evento?.designado?.apelido}
                    </span>
                </div>
            ))}
        </>
    )
}

export default function Calendario() {
    const { data: calendario } = useEventosCalendario()
    const calendarioData = calendario?.data

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Calendário</h6>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-3 mt-3">
                <div className="w-full py-1 bg-azul-claro rounded-md text-center text-aurora uppercase font-averta font-bold">
                    Programas
                </div>
                <div className="w-full py-1 bg-[#b82bff] rounded-md text-center text-aurora uppercase font-averta font-bold">
                    Lives
                </div>
                <div className="w-full py-1 bg-[#f43e37] rounded-md text-center text-aurora uppercase font-averta font-bold">
                    Youtube
                </div>
                <div className="w-full py-1 bg-[#00a859] rounded-md text-center text-aurora uppercase font-averta font-bold">
                    Podcast
                </div>
                {[...Array(3)].map((_, index) => (
                    <div key={index} className="hidden lg:block w-full py-1 bg-azul-claro rounded-md text-center text-aurora uppercase font-averta font-bold">
                    </div>
                ))}
            </div>''
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-3 mt-5">
                <div className="w-full">
                    <h6 className="text-aurora text-lg text-center font-averta font-bold uppercase italic">
                        Dom
                    </h6>
                    <div className="mt-4">
                        {renderConteudo(calendarioData, 'domingo')}
                    </div>
                </div>
                <div className="w-full">
                    <h6 className="text-aurora text-lg text-center font-averta font-bold uppercase italic">
                        Seg
                    </h6>
                    <div className="mt-4">
                        {renderConteudo(calendarioData, 'segunda')}
                    </div>
                </div>
                <div className="w-full">
                    <h6 className="text-aurora text-lg text-center font-averta font-bold uppercase italic">
                        Ter
                    </h6>
                    <div className="mt-4">
                        {renderConteudo(calendarioData, 'terca')}
                    </div>
                </div>
                <div className="w-full">
                    <h6 className="text-aurora text-lg text-center font-averta font-bold uppercase italic">
                        Qua
                    </h6>
                    <div className="mt-4">
                        {renderConteudo(calendarioData, 'quarta')}
                    </div>
                </div>
                <div className="w-full">
                    <h6 className="text-aurora text-lg text-center font-averta font-bold uppercase italic">
                        Qui
                    </h6>
                    <div className="mt-4">
                        {renderConteudo(calendarioData, 'quinta')}
                    </div>
                </div>
                <div className="w-full">
                    <h6 className="text-aurora text-lg text-center font-averta font-bold uppercase italic">
                        Sex
                    </h6>
                    <div className="mt-4">
                        {renderConteudo(calendarioData, 'sexta')}
                    </div>
                </div>
                <div className="w-full">
                    <h6 className="text-aurora text-lg text-center font-averta font-bold uppercase italic">
                        Sáb
                    </h6>
                    <div className="mt-4">
                        {renderConteudo(calendarioData, 'sabado')}
                    </div>
                </div>
            </div>

        </section>
    )
}