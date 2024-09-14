export default function TodasAsPublicacoesPlaceholder() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Todas as matérias</h6>
            </div>
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 mt-3">
                {[...Array(5)].map((_, index) => (
                    <div key={index} className="h-40 bg-azul-placeholder p-2 rounded-md animate-pulse">

                    </div>
                ))}
            </div>
        </section>
    )
}