import { InfiniteData } from '@tanstack/react-query';

interface Page<T> {
    data: T[];
}

interface usePaginationProps<T> {
    data: InfiniteData<Page<T>> | undefined;
}

export function usePagination<T>({ data }: usePaginationProps<T>): T[] {
    if (!data || !data.pages) {
        return [];
    }
    return data.pages.flatMap((page) => page.data);
}