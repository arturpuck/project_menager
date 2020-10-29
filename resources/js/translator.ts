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
            work_range : "Zakres prac"
        }
    }
};

export default function(packageName:string):string{
          const language = document.getElementsByTagName('html')[0].getAttribute('lang');
          return translations[language][packageName];
}