export default function Programas() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto pt-8">
            <div className="title-default">
                <h6>Meus Programas</h6>
            </div>
            <div className="gap-10 xl:gap-0 flex flex-wrap justify-center items-center my-3">
                <div className="xl:border-r xl:pl-10 xl:pr-10">
                    <img className="w-52" src="https://i.imgur.com/hLYHMUm.png" alt="logo do programa" />
                </div>
                <div className="xl:border-r xl:pl-10 xl:pr-10">
                    <img className="w-52" src="https://i.imgur.com/hLYHMUm.png" alt="logo do programa" />
                </div>
                <div className="xl:border-r xl:pl-10 xl:pr-10">
                    <img className="w-52" src="https://i.imgur.com/hLYHMUm.png" alt="logo do programa" />
                </div>
                <div className="flex items-center xl:ml-10">
                    <button className="px-16 py-1 border-4 border-azul-claro rounded-xl font-averta font-bold text-aurora text-xl text-azul-claro uppercase">
                        Cadastrar
                    </button>
                </div>
            </div>
        </section>
    )
}