export default function AvisosParaEquipePlaceholder() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Avisos para equipe</h6>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-3">
                {[...Array(4)].map((_, index) => (
                    <div key={index} className="w-full h-40 bg-azul-placeholder rounded-md p-3 animate-pulse">
                        <div></div>
                    </div>
                ))}
            </div>
        </section>
    )
}