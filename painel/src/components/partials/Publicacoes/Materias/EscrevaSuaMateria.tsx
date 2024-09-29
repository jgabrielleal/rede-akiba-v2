import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import { useMateria } from "@/services/materias/queries";

import EscrevaSuaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/EscrevaSuaPublicacao/EscrevaSuaPublicacaoPlaceholder";

export default function EscrevaSuaMateria({ register, setValue }: any) {
    const { slug } = useParams();
    const { data: materia, isLoading } = useMateria(slug ?? "");

    const[isConteudo, setConteudo] = useState<string | null>();

    useEffect(() => {
        if(slug && materia) {
            setConteudo(materia.conteudo ?? "")           
            register("conteudo");
            setValue("conteudo", materia.conteudo ?? "");
        }
    }, [slug, materia]);

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
                Escreva sua Matéria
            </span>            
            <div className="bg-aurora h-96 rounded-md">
                <ReactQuill 
                    theme="snow" 
                    modules={modules} value={isConteudo ?? ""} 
                    onChange={(content) => {setValue("conteudo", content)}}
                />
            </div>
        </section>
    );
}