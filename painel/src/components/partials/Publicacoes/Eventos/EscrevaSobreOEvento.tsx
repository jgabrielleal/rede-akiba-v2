import { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import { useEvento } from "@/services/eventos/queries";

import EscrevaSuaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/EscrevaSuaPublicacao/EscrevaSuaPublicacaoPlaceholder";

export default function EscrevaSobreOEvento({ register, setValue }: any) {
    const { slug } = useParams();
    const { data: evento, isLoading } = useEvento(slug ?? "");

    register("conteudo");

    if (isLoading) {
        return <EscrevaSuaPublicacaoPlaceholder />;
    }

    const modules = {
        toolbar: [
            [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'align': [] }],
            [{ 'color': [] }, { 'background': [] }],
            ['link', 'image', 'video'],
            ['clean'] // remove formatting button
        ]
    };

    return (
        <section>
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Escreva sobre o evento
            </span>            
            <div className="bg-aurora h-96 rounded-md">
                <ReactQuill 
                    theme="snow" 
                    modules={modules} 
                    value={evento?.conteudo ?? ""} 
                    onChange={(content) => { setValue("conteudo", content) }}
                />
            </div>
        </section>
    );
}