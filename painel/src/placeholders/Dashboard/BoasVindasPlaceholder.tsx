export default function BoasVindasPlaceholder() {
    return (
        <section className="flex justify-center">
            <div className="w-10/12 xl:w-[45rem] mt-10 border-4 border-blue-300 py-2 px-4 rounded-xl">
                <div className="animate-pulse">
                    <div className="h-8 bg-gray-300 rounded mb-4 w-3/5"></div>
                    <div className="h-6 bg-gray-300 rounded mb-2 w-full"></div>
                    <div className="h-6 bg-gray-300 rounded mb-2 w-full"></div>
                    <div className="h-6 bg-gray-300 rounded w-full"></div>
                </div>
            </div>
        </section>
    );
}