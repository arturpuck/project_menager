const translations:object = {
    pl : {
        navbar : {
            projects : "Projekty",
            team : "Team",
            payouts : "Wypłaty",
            income : "Dochód",
            cashflow : "Cashflow",
            gantt : "Gantt",
            uploader : "Uploader",
            logout : "Wyloguj"
        },

        project_form : {
            client_data : "Dane klienta",
            client_contact_person : "Osoba do kontaktu",
            client_phone_number : "Telefon kontaktowy",
            client_email : "Email",
            close : "Zamknij",
            invoice_data : "Dane do faktury",
            company_name : "Nazwa firmy",
            tax_identification_number : "NIP",
            addres : "Adres",
            client : "Klient",
            project_basic_data : "Projekt - postawowe dane",
            name : "Nazwa",
            project_menager : "Project menager",
            work_range : "Zakres prac",
            choose_range : "Wybierz zakres",
            engaged_persons : "Zaangażowane osoby",
            choose_persons : "Wybierz osoby",
            work_stages : "Etapy prac",
            add_work_stage : "Dodaj etap pracy",
            engaged_person : "Zaangażowana osoba",
            estimated_number_of_hours : "Estymacja(godziny)",
            estimated_ammount_of_money : "Wycena(PLN)",
            start_at : "Data rozpoczęcia",
            deadline : "Deadline",
            payment_stages : "Etapy płatności",
            ammount : "Kwota(PLN)",
            estimated_date_of_invoice : "Przewidywana data wystawienia faktury",
            status : "Status",
            remove_work_stage : "Usuń etap pracy",
            remove_payment_stage : "Usuń etap płatności",
            add_payment_stage : "Dodaj etap płatności",
            summary : "Podsumowanie",
            valuation : "Wycena",
            total_cost : "Całkowity koszt",
            current_currency : "PLN",
            finish_date : "Data zakończenia"
        }
    }
};

export default function(packageName:string):string{
          const language = document.getElementsByTagName('html')[0].getAttribute('lang');
          return translations[language][packageName];
}