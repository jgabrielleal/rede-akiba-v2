import LocalDatasPlaceholder from "@/components/skeletons/Publicacoes/LocalDatas/LocalDatasPlaceholder";

export default function LocalDatas() {
    return (
        <section className="w-[70rem] flex gap-5 lg:gap-10 justify-between flex-wrap lg:flex-nowrap">
            <div className="w-full">
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="local" className="font-averta text-laranja-claro text-center uppercase">
                        Local
                    </label>
                    <input type="text" id="local" name="local" className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" />
                </div>
            </div>
            <div className="w-full">
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="datas" className="font-averta text-laranja-claro text-center uppercase">
                        Datas
                    </label>
                    <input type="text" id="datas" name="datas" className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" />
                </div>
            </div>
        </section>
    )
}