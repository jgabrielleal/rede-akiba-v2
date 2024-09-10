import React, { useState } from 'react';

export default function ImagemEmDestaque() {
    const [imagemPreview, setImagemPreview] = useState<string | null>(null);

    const handleImageChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const file = event.target.files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                setImagemPreview(reader.result as string);
            };
            reader.readAsDataURL(file);
        }
    };

    return (
        <>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Imagem em destaque
            </span>
            <label htmlFor="imagemEmDestaque" className={`w-full ${!imagemPreview && "h-72 bg-aurora"} rounded-md flex justify-center items-center text-azul-claro text-6xl font-averta font-bold`}>
                {imagemPreview ? (
                    <img src={imagemPreview} alt="Imagem em destaque" className="w-full h-auto bg-aurora rounded-md object-cover" />
                ) : (
                    "+"
                )}
            </label>
            <input type="file" id="imagemEmDestaque" className="hidden" onChange={handleImageChange} />
        </>
    );
}