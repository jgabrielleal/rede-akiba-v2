export default function FontesDePesquisa() {
    return (
        <section className="w-[70rem] flex gap-5 lg:gap-10 justify-between flex-wrap lg:flex-nowrap">
            <div className="w-full">
                <span className="block font-averta font-bold text-laranja-claro text-center italic uppercase">
                    Primeira fonte de pesquisa
                </span>
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="primeiraFonteDePesquisaNome" className="font-averta text-laranja-claro text-center uppercase">
                        Nome
                    </label>
                    <input type="text" id="primeiraFonteDePesquisaNome" name="primeiraFonteDePesquisaNome" className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" />
                </div>
                <div className="flex justify-between items-center gap-4">
                    <label htmlFor="primeiraFonteDePesquisaLink" className="font-averta text-laranja-claro text-center uppercase">
                        Link
                    </label>
                    <input type="text" id="primeiraFonteDePesquisaLink" name="primeiraFonteDePesquisaLink" className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" />
                </div>
            </div>
            <div className="w-full">
                <span className="block font-averta font-bold text-laranja-claro text-center italic uppercase">
                    Segunda fonte de pesquisa
                </span>
                <div className="flex justify-between items-center gap-2 mb-3 mt-1">
                    <label htmlFor="segundaFonteDePesquisaNome" className="font-averta text-laranja-claro text-center uppercase">
                        Nome
                    </label>
                    <input type="text" id="segundaFonteDePesquisaNome" name="segundaFonteDePesquisaNome" className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" />
                </div>
                <div className="flex justify-between items-center gap-4">
                    <label htmlFor="segundaFonteDePesquisaLink" className="font-averta text-laranja-claro text-center uppercase">
                        Link
                    </label>
                    <input type="text" id="segundaFonteDePesquisaLink" name="segundaFonteDePesquisaLink" className="w-full xl:w-[29.5rem] h-10 w-full rounded-md outline-none px-2 bg-aurora" />
                </div>
            </div>
        </section>
    )
}