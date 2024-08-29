export default function Titulo(){
    return(
        <div className="w-full mb-3">
            <label htmlFor="titulo" className="font-averta font-bold text-laranja-claro text-lg uppercase block mb-1">
                Titulo
            </label>
            <input type="text" name="titulo" id="titulo" className="w-full outline-none rounded-md font-averta p-2" />
        </div>
    )
}