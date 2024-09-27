export function usePageName() {
    const setPageName = (name: string) => {
        document.title = name + " • AKI Painel - Rede Akiba ";
    };

    return { data: setPageName };
}