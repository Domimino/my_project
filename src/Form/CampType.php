namespace App\Form;

use App\Entity\Camp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Název'])
            ->add('type', ChoiceType::class, [
                'choices' => ['Jarní' => 'jarní', 'Letní' => 'letní'],
                'label' => 'Typ tábora'
            ])
            ->add('date', DateTimeType::class, ['label' => 'Datum a čas'])
            ->add('description', TextareaType::class, ['label' => 'Popis', 'required' => false])
            ->add('capacity', IntegerType::class, ['label' => 'Kapacita']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Camp::class]);
    }
}
