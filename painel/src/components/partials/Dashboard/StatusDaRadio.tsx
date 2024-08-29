import { FaChartSimple, FaSatellite, FaHeadphonesSimple  } from "react-icons/fa6";

export default function StatusDaRadio() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Status da rádio</h6>
            </div>
            <div className="flex flex-wrap gap-5 lg:gap-0 mt-3">
                <div className="flex itens-center gap-3 lg:border-r lg:pr-5">
                    <FaChartSimple className="text-azul-claro text-3xl"/>
                    <span className="text-laranja-claro text-2xl text-uppercase font-averta">320KBPS</span>
                </div>
                <div className="flex itens-center gap-3 lg:border-r lg:pl-5 lg:pr-5">
                    <FaSatellite className="text-azul-claro text-3xl"/>
                    <span className="text-laranja-claro text-2xl text-uppercase font-averta">ONLINE</span>
                </div>
                <div className="flex itens-center gap-3 lg:pl-5 lg:pr-5">
                    <FaHeadphonesSimple className="text-azul-claro text-3xl"/>
                    <span className="text-laranja-claro text-2xl text-uppercase font-averta">350 OUVINTES</span>
                </div>
            </div>
        </section>
    )
}