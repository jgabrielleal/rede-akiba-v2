export default function TodosOsReviewsFallback() {
    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <div className="title-default">
                <h6>Todas os reviews</h6>
            </div>
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 mt-3">
                <div className="bg-azul-fallback p-2 rounded-md">
                    <p className="h-[7.5rem] mb-3 line-clamp-6 font-averta uppercase text-aurora leading-5">
                       (╯°□°）╯︵ ┻━┻  Será que ninguém fez um review ainda? Quero descobrir novos animes! (٭°̧̧̧ω°̧̧̧٭)
                    </p>
                    <div className="flex justify-between">
                        <span className="text-aurora font-averta font-bold italic uppercase">
                            Aki-chan
                        </span>
                    </div>
                </div>
            </div>
        </section>
    )
}