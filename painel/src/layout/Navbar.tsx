import icone from '/images/icone.jpg'

export default function Navbar(){
    return (
        <nav className="bg-aurora h-15">
            <div className="w-[80rem] h-15 mx-auto">
                <div className="h-14">
                    <img src={icone} className="w-8 py-[0.78rem]" alt="icone da logomarca"/>
                </div>
            </div>
        </nav>
    )
}