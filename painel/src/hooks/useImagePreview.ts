import React, { useState } from 'react';

export function useImagePreview() {
    const [preview, setPreview] = useState<string | null>(null);

    function resizeImage(file: File, maxWidth: number, maxHeight: number, callback: (base64: string) => void) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (event) => {
            const img = new Image();
            img.src = event.target?.result as string;
            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                let width = img.width;
                let height = img.height;

                if (width > height) {
                    if (width > maxWidth) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }
                canvas.width = width;
                canvas.height = height;
                ctx?.drawImage(img, 0, 0, width, height);
                const dataUrl = canvas.toDataURL('image/jpeg');
                callback(dataUrl);
            };
        };
    }

    function converter(e: React.ChangeEvent<HTMLInputElement>, setValue: (field: string, value: string) => void, campo: string) {
        const file = e.target.files?.[0];
        if (file) {
            resizeImage(file, 800, 800, (base64String) => {
                setValue(campo, base64String);
                setPreview(base64String);
            });
        }
    }

    return { converter, preview, setPreview };
}