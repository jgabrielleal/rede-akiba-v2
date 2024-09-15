import { useParams } from 'react-router-dom';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import EscrevaSuaPublicacaoPlaceholder from "@/components/skeletons/Publicacoes/EscrevaSuaPublicacao/EscrevaSuaPublicacaoPlaceholder";

export default function EscrevaSeuReview() {
    const { publicacao } = useParams();

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
                Escreva seu review
            </span>            
            <div className="flex gap-2 flex-wrap mb-1">
                <button className="bg-aurora text-laranja-claro font-averta font-bold uppercase px-4 py-1 rounded-md">
                    Neko Kirame
                </button>
                <button className="bg-aurora text-laranja-claro font-averta font-bold uppercase px-4 py-1 rounded-md">
                    Suzuh
                </button>
            </div>
            <div className="bg-aurora h-96 rounded-md">
                <ReactQuill theme="snow" modules={modules} />
            </div>
        </section>
    );
}