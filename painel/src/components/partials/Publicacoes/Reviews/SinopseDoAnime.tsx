import { useParams } from "react-router-dom";
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import { useReview } from '@/services/reviews/queries';
import SinopseDoAnimePlaceholder from "@/components/skeletons/Publicacoes/SinopseDoAnime/SinopseDoAnimePlaceholder";

export default function SinopseDoAnime({ register, setValue }: any) {
    const { slug } = useParams();
    const { data: review, isLoading } = useReview(slug ?? "");

    register("sinopseDoAnime");

    if (isLoading) {
        return <SinopseDoAnimePlaceholder />
    }

    const modules = {
        toolbar: [
            [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'align': [] }],
            [{ 'color': [] }, { 'background': [] }],
            ['link', 'image', 'video'],
            ['clean'] // remove formatting button
        ]
    };

    return (
        <section className="mb-3">
            <span className="mb-1 block font-averta font-bold text-laranja-claro text-lg uppercase">
                Sinopse do anime
            </span>
            <div className="bg-aurora h-60 rounded-md">
                <ReactQuill 
                    theme="snow" 
                    modules={modules} 
                    value={review?.sinopse} 
                    onChange={(content) => {setValue("sinopseDoAnime", content)}} />
            </div>
        </section>
    );
}