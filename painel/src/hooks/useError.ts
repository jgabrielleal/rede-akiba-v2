import { toast } from 'react-toastify';

export function useError() {
    const onError = (errors: any) => {
        for (const error in errors) {
            toast.error(errors[error].message);
        }
    };

    return { data: onError };
}