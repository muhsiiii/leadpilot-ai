<?php

namespace Database\Seeders;

use App\Models\Prospect;
use Illuminate\Database\Seeder;

class ProspectSeeder extends Seeder
{
    public function run(): void
    {
        $prospects = [
            [
                'business_name' => 'Rafa Dental Clinic',
                'category' => 'Dental clinic',
                'area' => 'Koduvally, Kozhikode',
                'website' => null,
                'phone' => '09747801704',
                'contact_channel' => 'Phone / Facebook',
                'public_signal' => 'Public listing shows phone and Facebook, but no website listed.',
                'pain_hypothesis' => 'Likely loses online search visitors who want treatment details, pricing range, appointment timing, and a quick callback.',
                'proposed_solution' => 'Starter AI appointment enquiry page with services, FAQ, lead capture, and instant owner notification.',
                'budget_fit' => 'basic',
                'priority_score' => 88,
                'status' => 'research',
                'notes' => 'Good first outreach because no full website means lower barrier: sell simple online enquiry page plus AI lead capture.',
            ],
            [
                'business_name' => 'DR.LINCY\'S Smilax Dental Clinic',
                'category' => 'Dental clinic',
                'area' => 'Parambil Bazar, Kozhikode',
                'website' => 'https://minzaann.wixsite.com',
                'phone' => '09447934697',
                'contact_channel' => 'Phone',
                'public_signal' => 'Public listing shows a small Wix website and limited online presence.',
                'pain_hypothesis' => 'May need a stronger mobile-friendly enquiry flow for dental cleaning, fillings, braces, and appointment questions.',
                'proposed_solution' => 'Upgrade existing online presence with AI FAQ, callback capture, and lead dashboard.',
                'budget_fit' => 'basic',
                'priority_score' => 82,
                'status' => 'research',
                'notes' => 'Small clinic, likely price sensitive. Pitch ₹3,000 pilot, not a big custom software project.',
            ],
            [
                'business_name' => 'U S Cosmetics Studio & Academy',
                'category' => 'Salon and academy',
                'area' => 'Velliparamba, Kozhikode',
                'website' => 'https://uscosmeticsstudio.in/',
                'phone' => '+918891736617',
                'contact_channel' => 'WhatsApp',
                'public_signal' => 'Website lists services, prices, offers, WhatsApp booking, and academy courses.',
                'pain_hypothesis' => 'High enquiry variety: bridal packages, academy courses, offers, service pricing, availability. Manual WhatsApp replies can become repetitive.',
                'proposed_solution' => 'AI booking assistant that qualifies bridal, salon, and academy leads before sending them to WhatsApp.',
                'budget_fit' => 'advanced',
                'priority_score' => 76,
                'status' => 'research',
                'notes' => 'Can afford more than basic if positioned as saving WhatsApp time and improving bridal/course lead quality.',
            ],
            [
                'business_name' => 'Aurum Dentistry',
                'category' => 'Dental clinic',
                'area' => 'Karaparamba, Kozhikode',
                'website' => 'https://www.aurumdentistry.in/',
                'phone' => '+917012854171',
                'contact_channel' => 'Website / phone',
                'public_signal' => 'Modern website with appointment form, treatment categories, and Sunday availability.',
                'pain_hypothesis' => 'Already has a good site, but could improve after-hours Q&A, treatment qualification, and lead follow-up speed.',
                'proposed_solution' => 'Premium AI treatment enquiry assistant, embedded into website, with lead notification and monthly report.',
                'budget_fit' => 'advanced',
                'priority_score' => 72,
                'status' => 'research',
                'notes' => 'Harder sale because they already invested in website. Pitch as conversion improvement, not website replacement.',
            ],
            [
                'business_name' => 'Ivory Dental Clinic',
                'category' => 'Dental clinic',
                'area' => 'Palayam, Kozhikode',
                'website' => 'https://www.ivorydentalclinic.com/',
                'phone' => '04954019046',
                'contact_channel' => 'Phone / website',
                'public_signal' => 'Directory listing shows 4.7 rating and many dental services.',
                'pain_hypothesis' => 'A broad service list creates repeated questions around braces, whitening, implants, child dentistry, and timing.',
                'proposed_solution' => 'AI dental service guide that collects requirement and phone before staff follow-up.',
                'budget_fit' => 'medium',
                'priority_score' => 69,
                'status' => 'research',
                'notes' => 'Use as second-wave prospect after simpler clinics.',
            ],
        ];

        foreach ($prospects as $prospect) {
            Prospect::updateOrCreate(
                ['business_name' => $prospect['business_name']],
                $prospect,
            );
        }
    }
}
