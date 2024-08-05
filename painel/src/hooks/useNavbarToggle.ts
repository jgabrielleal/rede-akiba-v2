import { useRef } from 'react';

export function useNavbarToggle() {
    const navlist = useRef<HTMLUListElement>(null);

    function toggle() {
        navlist.current?.classList.remove('hidden');
        navlist.current?.classList.add('nav-animation-open');

        const navclose = document.createElement('div');
        navclose.style.zIndex = '1';
        navclose.style.position = 'fixed';
        navclose.style.inset = '0px';
        navclose.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        document.body.appendChild(navclose);

        navclose.addEventListener('click', () => {
            navlist.current?.classList.remove('nav-animation-open');
            navlist.current?.classList.add('nav-animation-close');
            navclose.remove();

            setTimeout(() => {
                navlist.current?.classList.add('hidden');
                navlist.current?.classList.remove('nav-animation-close');
            }, 500);
        });
    }

    return { navlist, toggle };
}