import React from 'react';

export function useImagePreview() {
    const handleImagePreview = (event: React.ChangeEvent<HTMLInputElement>, setImagemPreview: (value: string | null) => void) => {
        const file = event.target.files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                setImagemPreview(reader.result as string);
            };
            reader.readAsDataURL(file);
        }
    };

    return { data: handleImagePreview };
}