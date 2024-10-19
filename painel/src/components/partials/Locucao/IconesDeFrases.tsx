import { useState } from 'react';
import classNames from 'classnames';

import Aladdin from '/images/avatares/Aladdin.png';
import AnimeGirl from '/images/avatares/AnimeGirl.png';
import AnimeGirlCatEar from '/images/avatares/AnimeGirl(CatEar).png';
import AsuzaKon from '/images/avatares/AsuzaK-on.png';
import EdwardElric from '/images/avatares/EdwardElric.png';
import MyaNee from '/images/avatares/Mya-nee.png';
import REM from '/images/avatares/REM.png';
import Rin from '/images/avatares/Rin.png';
import TakashiKomuro from '/images/avatares/TakashiKomuro.png';
import TalesOfZestria from '/images/avatares/TalesofZestria.png';
import Tanjiro from '/images/avatares/Tanjiro.png';

export default function IconesDeFrases() {
    const [isIconeSelecionado, setIsIconeSelecionado] = useState<string | undefined>();

    const images = [
        Aladdin,
        AnimeGirl,
        AnimeGirlCatEar,
        AsuzaKon,
        EdwardElric,
        MyaNee,
        REM,
        Rin,
        TakashiKomuro,
        TalesOfZestria,
        Tanjiro
    ];

    return (
        <section className="w-10/12 xl:w-[75rem] mx-auto mt-8">
            <h6 className="font-averta font-bold text-laranja-claro text-lg uppercase block mb-1">
                Escolha uma imagem
            </h6>
            <div className="w-full mt-24 gap-4 flex flex-wrap">
                {images.map((imagem, index) => (
                    <div
                        key={index}
                        onClick={() => setIsIconeSelecionado(prev => prev === imagem ? undefined : imagem)}
                        className={classNames('cursor-pointer bg-aurora w-[8.5rem] h-12 rounded-md relative transition-transform', {
                            'opacity-45 scale-95': isIconeSelecionado === imagem,
                            'mb-24': index < images.length - 3,
                        })}>
                        <img src={imagem} alt={`icone${index + 1}`} className="w-22 absolute bottom-0" />
                    </div>
                ))}
            </div>
        </section>
    );
}
