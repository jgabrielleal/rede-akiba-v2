import React, { useState } from 'react';

export function useImagePreview() {
    const [ preview, setPreview ] = useState<string | null>(null);

    function converter(e: React.ChangeEvent<HTMLInputElement>, setValue: any, campo: string) {
        console.log(campo)
        const file = e.target.files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                const base64String = reader.result as string;                
                setValue(campo, base64String);
                setPreview(base64String);
            };
            reader.readAsDataURL(file);
        }
    };

    return { converter, preview, setPreview };
}