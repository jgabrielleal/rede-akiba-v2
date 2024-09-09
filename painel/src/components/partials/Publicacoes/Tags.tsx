export default function Tags() {
    return (
        <section className="w-[70rem] flex gap-5 lg:gap-10 justify-between flex-wrap lg:flex-nowrap">
            <div className="w-full">
                <label htmlFor="primeiraTag" className="mb-1 block font-averta font-bold text-lg text-azul-claro uppercase text-center">
                    Primeira Tag
                </label>
                <select id="primeiraTag" className="h-10 w-full bg-aurora rounded-md outline-none px-2">
                    <option value="anime">Animes</option>
                    <option value="mangas">Mangás</option>
                    <option value="tops">Top's</option>
                    <option value="primeiras-impressoes">Primeiras impressões</option>
                    <option value="eventos">Eventos</option>
                    <option value="listas">Listas</option>
                    <option value="curiosidades">Curiosidade</option>
                </select>
            </div>
            <div className="w-full">
                <label htmlFor="segundaTag" className="mb-1 block font-averta font-bold text-lg text-azul-claro uppercase text-center">
                    Segunda Tag
                </label>
                <select id="segundaTag" className="h-10 w-full bg-aurora rounded-md outline-none px-2">
                    <option value="anime">Animes</option>
                    <option value="mangas">Mangás</option>
                    <option value="tops">Top's</option>
                    <option value="primeiras-impressoes">Primeiras impressões</option>
                    <option value="eventos">Eventos</option>
                    <option value="listas">Listas</option>
                    <option value="curiosidades">Curiosidade</option>
                </select>
            </div>
        </section>
    )
}