import React, { useState } from 'react';
import classNames from 'classnames';

function OffcanvasClose() {
    const closeButton = document.querySelector('#close-offcanvas') as HTMLElement;
    if (closeButton) {
        closeButton.click();
    }
}

interface OffcanvasInterfaceProps {
    children: React.ReactNode;
    isOpen: boolean;
    handleClose: () => void;
    title: string;
}

function OffcanvasInterface({ isOpen, handleClose, children, title }: OffcanvasInterfaceProps) {
    return (
        <>
            {isOpen && <div id="close-offcanvas" className="fixed inset-0 bg-black bg-opacity-50 z-40" onClick={handleClose}></div>}
            <div className={classNames('fixed inset-y-0 right-0 z-50 flex transition-transform duration-300', {
                'translate-x-0': isOpen,
                'translate-x-full': !isOpen,
            })}>
                <div className="relative bg-aurora w-80 h-full shadow-lg">
                    <h6 className="font-averta font-bold text-azul-claro text-lg uppercase pt-6 pr-6 pl-6">{title}</h6>
                    <div className="p-6">
                        {children}
                    </div>
                </div>
            </div>
        </>
    );
}

interface OffcanvasProps {
    children: React.ReactNode;
    className?: string;
    button: string;
    title: string;
}

const Offcanvas: React.FC<OffcanvasProps> = ({ button, children, className, title }) => {
    const [isOpen, setIsOpen] = useState(false);

    const handleOpen = () => setIsOpen(true);
    const handleClose = () => setIsOpen(false);

    return (
        <div>
            <button className={className} onClick={handleOpen} aria-label={button}>{button}</button>
            <OffcanvasInterface isOpen={isOpen} handleClose={handleClose} title={title}>
                {children}
            </OffcanvasInterface>
        </div>
    );
};

export { Offcanvas, OffcanvasClose };