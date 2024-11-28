namespace App\Form;

use App\Entity\InterestGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterestGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Název'])
            ->add('schedule', TextType::class, ['label' => 'Rozvrh'])
            ->add('description', TextareaType::class, ['label' => 'Popis', 'required' => false])
            ->add('capacity', IntegerType::class, ['label' => 'Kapacita']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => InterestGroup::class]);
    }
}
